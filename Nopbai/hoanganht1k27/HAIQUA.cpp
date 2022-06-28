#include<bits/stdc++.h>
#define ii pair<int,int>
#define X first
#define Y second
using namespace std;
const int N=(1<<21)+4;
int n,w[N],check[N],f[N],sum[N],id[N],s[N],T[N];
vector<int> a[N],res;
int get(int x,int i)
{
    return (x>>i)&1;
}
void bdfs(int x,int h)
{
    if(h==n+1) return;
    a[x].push_back(2*x);
    a[x].push_back(2*x+1);
    T[2*x]=T[2*x+1]=x;
    bdfs(2*x,h+1);
    bdfs(2*x+1,h+1);
}
void DFS(int x,int h)
{
    if(h==n+1){
        sum[x]=w[x];
        return;
    }
    for(int i=0;i<a[x].size();i++)
    {
        DFS(a[x][i],h+1);
        sum[x]+=sum[a[x][i]];
    }
    s[x]=sum[a[x][0]]-sum[a[x][1]];
}
bool kt(int x)
{
    int t1=x;
    int keep=w[x];
    while(x!=1)
    {
        int p=T[x];
        if(x==a[p][0])
        {
            if(abs(s[p]-keep)>1) return false;
        }
        else
        {
            if(abs(s[p]+keep)>1) return false;
        }
        x=p;
    }
    x=t1;
    while(x!=1)
    {
        int p=T[x];
        if(x==a[p][0])
        {
            s[p]-=keep;
        }
        else
        {
            s[p]+=keep;
        }
        x=p;
    }
    return true;
}
void process()
{
    for(int j=1;j<=(1<<n);j++)
    {
    int kiemtra=0;
    for(int i=1;i<=(1<<n);i++)
    {
        if(w[i+(1<<n)-1]<1||w[i+(1<<n)-1]>2||check[i+(1<<n)-1]==1) continue;
        if(kt(i+(1<<n)-1)){
            kiemtra=1;
            res.push_back(i);
            check[i+(1<<n)-1]=1;
        }
    }
    if(kiemtra==0) break;
    }
    printf("%d\n",res.size());
    for(int i=0;i<res.size();i++) printf("%d ",res[i]);
}
int main()
{
    freopen("HAIQUA.INP","r",stdin);
    freopen("HAIQUA.OUT","w",stdout);
    scanf("%d",&n);
    int d2=0;
    for(int i=1;i<=(1<<n);i++)
    {
        scanf("%d",&w[i+(1<<n)-1]);
        if(w[i+(1<<n)-1]>1) d2++;
    }
    if(d2>2){
        cout<<0;
        return 0;
    }
    bdfs(1,1);
    DFS(1,1);
    process();
}
